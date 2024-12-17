import os
import pymysql
import random

# Fungsi untuk mengambil data dari tabel datasets
def fetch_data():
    connection = pymysql.connect(
        host=os.getenv('DB_HOST'),
        user=os.getenv('DB_USERNAME'),
        password=os.getenv('DB_PASSWORD'), # type: ignore
        db=os.getenv('DB_DATABASE'),
        charset='utf8mb4',
        cursorclass=pymysql.cursors.DictCursor # type: ignore
    ) # type: ignore
    try:
        with connection.cursor() as cursor:
            sql = "SELECT id, review, rating_id, classification_id FROM datasets"
            cursor.execute(sql)
            data = cursor.fetchall()
        return data
    finally:
        connection.close()

# Fungsi untuk memasukkan data ke tabel
def insert_data(table, data):
    connection = pymysql.connect(
        host=os.getenv('DB_HOST'),
        user=os.getenv('DB_USERNAME'),
        password=os.getenv('DB_PASSWORD'), # type: ignore
        db=os.getenv('DB_DATABASE'),
        charset='utf8mb4',
        cursorclass=pymysql.cursors.DictCursor # type: ignore
    ) # type: ignore
    try:
        with connection.cursor() as cursor:
            if table == 'trainings':
                insert_query = f"INSERT INTO {table} (id, review, rating_id, classification_id) VALUES (%s, %s, %s, %s)"
                cursor.executemany(insert_query, data)
            elif table == 'testings':
                insert_query = f"INSERT INTO {table} (id, review, rating_id, classification_id, sysclassification_id) VALUES (%s, %s, %s, %s, %s)"
                cursor.executemany(insert_query, data)
            connection.commit()
    finally:
        connection.close()

# Fungsi utama untuk membagi data dan memasukkan ke tabel
if __name__ == "__main__":
    try:
        # Mengambil data dari datasets
        data = fetch_data()
        random.shuffle(data)
        
        # Membagi data menjadi 80:20
        split_index = int(0.8 * len(data))
        training_data = data[:split_index]
        testing_data = data[split_index:]

        # Mengubah data menjadi bentuk tuple untuk keperluan insert
        training_data_tuples = [(item['id'], item['review'], item['rating_id'], item['classification_id']) for item in training_data]
        testing_data_tuples = [(item['id'], item['review'], item['rating_id'], item['classification_id'], 4) for item in testing_data]

        # Memasukkan data ke tabel trainings dan testings
        insert_data('trainings', training_data_tuples)
        insert_data('testings', testing_data_tuples)

        print(f"Inserted {len(training_data_tuples)} records into trainings table.")
        print(f"Inserted {len(testing_data_tuples)} records into testings table.")

    except Exception as e:
        print("Error:", e)
