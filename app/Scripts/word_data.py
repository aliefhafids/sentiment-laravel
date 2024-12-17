import os
import pymysql
from nltk.tokenize import word_tokenize
from nltk.corpus import stopwords
from nltk.stem import PorterStemmer
from wordcloud import WordCloud
import matplotlib.pyplot as plt
import json
import re

# Download data NLTK untuk penggunaan pertama kali
import nltk
nltk.download('punkt')
nltk.download('stopwords')

def preprocess_text(text):
    # Menghapus indeks ke 0-27
    text = text[27:]
    
    # Menghapus kata 'laporkan', 'penyalahgunaan', 'membantu' dan angka
    words_to_remove = ["Membantu", "Laporkan", "Penyalahgunaan", "|", "?"]
    # Pastikan urutan kata-kata dalam words_to_remove dari yang lebih spesifik hingga yang lebih umum jika perlu
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

def generate_wordcloud(text):
    wordcloud = WordCloud(width=800, height=400, background_color='white').generate(text)
    plt.figure(figsize=(10, 5))
    plt.imshow(wordcloud, interpolation='bilinear')
    plt.axis('off')
    plt.show()

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
            sql = "SELECT review FROM trainings"
            # Eksekusi query
            cursor.execute(sql)
            # Ambil semua hasil
            reviews = cursor.fetchall()
            preprocessed_data = []
            for i, review in enumerate(reviews):
                try:
                    # Melakukan preprocessing pada setiap review terlebih dahulu
                    preprocessed_review = preprocess_text(review['review'])
                    preprocessed_data.append({"Review": i+1, "Text": preprocessed_review})
                except Exception as e:
                    preprocessed_data.append({"Review": i+1, "Error": str(e)})
            
            # Gabungkan semua ulasan yang telah diproses menjadi satu teks
            combined_text = ' '.join([review['Text'] for review in preprocessed_data])

            # Hasilkan word cloud
            generate_wordcloud(combined_text)

    except Exception as e:
        print("Error:", e)
    finally:
        connection.close()
