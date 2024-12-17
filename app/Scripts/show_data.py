import os
import pymysql

if __name__ == "__main__":
    try:
        # Koneksi ke Database
        connection = pymysql.connect(host=os.getenv('DB_HOST'),
                                    user=os.getenv('DB_USERNAME'),
                                    password=os.getenv('DB_PASSWORD'),
                                    db=os.getenv('DB_DATABASE'),
                                    charset='utf8mb4',
                                    cursorclass=pymysql.cursors.DictCursor)

        # Query untuk mengambil data review dari tabel database
        with connection.cursor() as cursor:
            sql = "SELECT review FROM trainings"
            # Eksekusi query
            cursor.execute(sql)
            # Ambil semua hasil
            reviews = cursor.fetchall()
            preprocessed_data = "Data Reviews:\n"
            for i, review in enumerate(reviews):
                try:
                    # Mengabaikan karakter yang tidak dapat dienkoding
                    review_text = review['review'].encode('ascii', 'ignore').decode()
                    preprocessed_data += f"Review {i+1}: {review_text}\n"
                except Exception as e:
                    preprocessed_data += f"Review {i+1}: Error - {e}\n"
            print(preprocessed_data)
    except Exception as e:
        print("Error:", e)
    finally:
        connection.close()
