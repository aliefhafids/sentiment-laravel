import requests
from bs4 import BeautifulSoup

def scrape_website(url):
    try:
        # Mengirim permintaan HTTP GET ke URL
        response = requests.get(url)
        response.raise_for_status()  # Memeriksa jika ada kesalahan dalam permintaan

        # Membuat objek BeautifulSoup untuk parsing HTML
        soup = BeautifulSoup(response.text, 'html.parser')

        # Menemukan dan mengambil elemen yang diinginkan
        target_elements = soup.find_all('div', class_='css-1k41fl7')  # Ganti dengan kelas atau tag yang sesuai
        # Lakukan operasi lain sesuai kebutuhan, misalnya ekstraksi teks atau atribut

        # Mengembalikan elemen yang diambil
        return target_elements

    except requests.exceptions.RequestException as e:
        print("Error during HTTP request:", str(e))
        return None
    except Exception as e:
        print("Error:", str(e))
        return None

# URL halaman web yang akan di-scrape
url = "https://www.tokopedia.com/laily0205/lipstik-implora-urban-lip-cream-matte-01-02-03-04-06-08-09-10-11-01-nude/review"

# Panggil fungsi untuk melakukan scraping
scraped_elements = scrape_website(url)

# Cetak hasil scraping jika berhasil
if scraped_elements:
    for element in scraped_elements:
        print(element)
else:
    print("Scraping failed.")
