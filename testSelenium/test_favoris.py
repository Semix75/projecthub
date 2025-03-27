from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.common.keys import Keys

# Configuration du navigateur
options = webdriver.ChromeOptions()
# options.add_argument("--headless")  # Décommente pour exécuter sans interface
driver = webdriver.Chrome(options=options)

try:
    wait = WebDriverWait(driver, 10)

    # 🟢 1. Connexion à l'application
    driver.get("http://127.0.0.1:8000/login")
    print("Page de connexion chargée.")

    email = wait.until(EC.presence_of_element_located((By.NAME, "email")))
    password = wait.until(EC.presence_of_element_located((By.NAME, "password")))

    email.send_keys("amel@gmail.com")  # Remplace avec un compte valide
    password.send_keys("amel123")  # Remplace avec le bon mot de passe
    password.send_keys(Keys.RETURN)

    # Attendre la redirection vers la page de profil
    wait.until(EC.url_contains("/profil"))
    print("✅ Connexion réussie !")

    # 🟢 2. Accéder à la page "Mes favoris"
    driver.get("http://127.0.0.1:8000/favoris")
    print("Page des favoris chargée.")

    # 🟢 3. Vérifier que la page contient bien "Mes favoris"
    favoris_title = wait.until(EC.presence_of_element_located((By.XPATH, "//*[contains(text(), 'Mes favoris')]")))
    print("✅ Accès à la page des favoris confirmé !")

except Exception as e:
    print("❌ Erreur :", e)
    print("Page source :", driver.page_source)

finally:
    driver.quit()
