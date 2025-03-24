from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC

# Configuration du navigateur (sans fenêtre pour exécution silencieuse)
options = webdriver.ChromeOptions()
options.add_argument("--headless")  # Exécute sans ouvrir de fenêtre
driver = webdriver.Chrome(options=options)

try:
    # Ouvre la page de connexion
    driver.get("http://127.0.0.1:8000/login")
    print("URL actuelle :", driver.current_url)

    # Attente de la présence des champs du formulaire
    wait = WebDriverWait(driver, 10)
    username = wait.until(EC.presence_of_element_located((By.NAME, "email")))
    password = wait.until(EC.presence_of_element_located((By.NAME, "password")))

    # Remplit le formulaire et soumet
    username.send_keys("amel@gmail.com") # Remplacez par un email existant dans la db
    password.send_keys("amel123") # Remplacez par le mot de passe correspondant
    password.send_keys(Keys.RETURN)

    # Attendre la redirection
    wait.until(EC.url_changes("http://127.0.0.1:8000/login"))
    
    # Vérifie l'URL après connexion
    print("URL après connexion :", driver.current_url)
    assert driver.current_url == "http://127.0.0.1:8000/profil"

    # Vérifie la présence du texte "Mon Profil"
    assert "Mon Profil" in driver.page_source
    print("Connexion réussie !")

except Exception as e:
    print("Erreur :", e)
    print("Page source :", driver.page_source)

finally:
    # Ferme le navigateur
    driver.quit()
