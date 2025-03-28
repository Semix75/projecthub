from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.common.keys import Keys

# Configuration du navigateur
options = webdriver.ChromeOptions()
driver = webdriver.Chrome(options=options)

try:
    wait = WebDriverWait(driver, 10)

    # 🟢 1. Connexion à l'application
    driver.get("http://127.0.0.1:8000/login")
    print("Page de connexion chargée.")

    email = wait.until(EC.presence_of_element_located((By.NAME, "email")))
    password = wait.until(EC.presence_of_element_located((By.NAME, "password")))

    email.send_keys("amel@gmail.com")  
    password.send_keys("amel123")  
    password.send_keys(Keys.RETURN)

    # Attendre la redirection vers la page de profil
    wait.until(EC.url_contains("/profil"))
    print("✅ Connexion réussie !")

    # 🟢 2. Accéder à la page "Groupe"
    driver.get("http://127.0.0.1:8000/groups")
    print("Page Groupe chargée.")

    # 🟢 3. Vérifier que la page contient bien "Groupe"
    groupe_title = wait.until(EC.presence_of_element_located((By.XPATH, "//*[contains(text(), 'Groupe')]")))
    print("✅ Accès à la page Groupe confirmé !")

except Exception as e:
    print("❌ Erreur :", e)
    print("Page source :", driver.page_source)

finally:
    driver.quit()
