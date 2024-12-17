import os
import pymysql
import re
from nltk.tokenize import word_tokenize
from nltk.corpus import stopwords
from nltk.stem import PorterStemmer
from sklearn.neighbors import KNeighborsClassifier
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics import confusion_matrix, precision_score, recall_score, accuracy_score

# Download data NLTK untuk penggunaan pertama kali
import nltk

nltk.download('punkt')
nltk.download('stopwords')

def preprocess_text(text):
    # Menghapus indeks ke 0-27
    text = text[27:]
    
    # Menghapus kata 'laporkan', 'penyalahgunaan', 'membantu' dan angka
    words_to_remove = ["Membantu", "Laporkan", "Penyalahgunaan", "|", "?"]
    words_to_remove.sort(key=len, reverse=True)

    for word in words_to_remove:
        text = text.replace(word, '')

    # Menghapus angka menggunakan regular expression
    text = re.sub(r'\d+', '', text)

    # Menghapus karakter tanda baca
    text = re.sub(r'[^\w\s]', '', text)

    # Case Folding (Ubah semua teks menjadi huruf kecil)
    text = text.lower()

    # Tokenisasi
    tokens = word_tokenize(text)

    # Inisialisasi Stopword Bahasa Indonesia
    stop_words = set(stopwords.words('indonesian'))

    # Remove Stopwords
    filtered_tokens = [word for word in tokens if word not in stop_words]

    # Stemming (Menggunakan Porter Stemmer)
    stemmer = PorterStemmer()
    stemmed_tokens = [stemmer.stem(word) for word in filtered_tokens]

    # Gabungkan kembali token-token yang telah di-stem menjadi teks
    preprocessed_text = ' '.join(stemmed_tokens)

    return preprocessed_text

def preprocess_and_classify(reviews):
    preprocessed_reviews = []
    labels = []
    for review in reviews:
        preprocessed_review = preprocess_text(review['review'])
        preprocessed_reviews.append(preprocessed_review)
        labels.append(review['classification_id'])

    # Mengubah data teks yang telah dipreproses menjadi vektor TF-IDF
    vectorizer = TfidfVectorizer()
    X = vectorizer.fit_transform(preprocessed_reviews)

    # Inisialisasi model KNN
    knn_classifier = KNeighborsClassifier(n_neighbors=3)

    # Menyesuaikan model dengan data
    knn_classifier.fit(X, labels)

    return knn_classifier, vectorizer 

def save_classification(preprocessed_review, rating_id, classification_id, sysclassification_id):
    try:
        # Koneksi ke Database
        connection = pymysql.connect(host=os.getenv('DB_HOST'),
                                     user=os.getenv('DB_USERNAME'),
                                     password=os.getenv('DB_PASSWORD'), # type: ignore
                                     db=os.getenv('DB_DATABASE'),
                                     charset='utf8mb4',
                                     cursorclass=pymysql.cursors.DictCursor) # type: ignore

        # Masukkan hasil klasifikasi ke dalam tabel result
        with connection.cursor() as cursor:
            sql = "INSERT INTO results (review, rating_id, classification_id, sysclassification_id) VALUES (%s, %s, %s, %s)"
            cursor.execute(sql, (preprocessed_review, rating_id, classification_id, sysclassification_id))
            connection.commit()

    except Exception as e:
        print("Error:", e)
    finally:
        connection.close()

# Fungsi untuk menghitung confusion matrix
def calculate_confusion_matrix(reviews, knn_classifier, vectorizer):
    preprocessed_reviews = [preprocess_text(review['review']) for review in reviews]
    labels = [review['classification_id'] for review in reviews]

    # Klasifikasikan setiap review
    review_vectors = vectorizer.transform(preprocessed_reviews)
    predicted_labels = knn_classifier.predict(review_vectors)

    # Hitung confusion matrix
    conf_matrix = confusion_matrix(labels, predicted_labels)
    return conf_matrix

# Fungsi untuk menghitung precision
def calculate_precision(reviews, knn_classifier, vectorizer):
    preprocessed_reviews = [preprocess_text(review['review']) for review in reviews]
    labels = [review['classification_id'] for review in reviews]

    # Klasifikasikan setiap review
    review_vectors = vectorizer.transform(preprocessed_reviews)
    predicted_labels = knn_classifier.predict(review_vectors)

    # Hitung precision
    precision = precision_score(labels, predicted_labels, average='macro')
    return precision

# Fungsi untuk menghitung recall
def calculate_recall(reviews, knn_classifier, vectorizer):
    preprocessed_reviews = [preprocess_text(review['review']) for review in reviews]
    labels = [review['classification_id'] for review in reviews]

    # Klasifikasikan setiap review
    review_vectors = vectorizer.transform(preprocessed_reviews)
    predicted_labels = knn_classifier.predict(review_vectors)

    # Hitung recall
    recall = recall_score(labels, predicted_labels, average='macro')
    return recall

# Fungsi untuk menghitung akurasi
def calculate_accuracy(reviews, knn_classifier, vectorizer):
    preprocessed_reviews = [preprocess_text(review['review']) for review in reviews]
    labels = [review['classification_id'] for review in reviews]

    # Klasifikasikan setiap review
    review_vectors = vectorizer.transform(preprocessed_reviews)
    predicted_labels = knn_classifier.predict(review_vectors)

    # Hitung akurasi
    accuracy = accuracy_score(labels, predicted_labels)
    return accuracy

if __name__ == "__main__":
    try:
        # Koneksi ke Database
        connection = pymysql.connect(host=os.getenv('DB_HOST'),
                                     user=os.getenv('DB_USERNAME'),
                                     password=os.getenv('DB_PASSWORD'), # type: ignore
                                     db=os.getenv('DB_DATABASE'),
                                     charset='utf8mb4',
                                     cursorclass=pymysql.cursors.DictCursor) # type: ignore

        # Query untuk mengambil data review dari tabel database
        with connection.cursor() as cursor:
            sql = "SELECT id, review, rating_id, classification_id FROM trainings"
            # Eksekusi query
            cursor.execute(sql)
            # Ambil semua hasil
            reviews = cursor.fetchall()

            # Preprocessing dan klasifikasi
            knn_classifier, vectorizer = preprocess_and_classify(reviews)

            # Hitung confusion matrix
            conf_matrix = calculate_confusion_matrix(reviews, knn_classifier, vectorizer)

            # Tampilkan confusion matrix
            print("Confusion Matrix:")
            print(conf_matrix)

            # Hitung precision
            precision = calculate_precision(reviews, knn_classifier, vectorizer)
            print("Precision:", precision)

            # Hitung recall
            recall = calculate_recall(reviews, knn_classifier, vectorizer)
            print("Recall:", recall)

             # Hitung akurasi
            accuracy = calculate_accuracy(reviews, knn_classifier, vectorizer)
            print("Accuracy:", accuracy)

            # Klasifikasikan setiap review dan simpan hasilnya
            for review in reviews:
                preprocessed_review = preprocess_text(review['review'])
                review_vector = vectorizer.transform([preprocessed_review])
                predicted_label = knn_classifier.predict(review_vector)
                sysclassification_id = predicted_label.item()  # Ubah ke integer
                # Gunakan nilai rating_id dan classification_id yang sama dari tabel trainings
                rating_id = review['rating_id']
                classification_id = review['classification_id']
                save_classification(preprocessed_review, rating_id, classification_id, sysclassification_id) # type: ignore

    except Exception as e:
        print("Error:", e)
    finally:
        connection.close()
