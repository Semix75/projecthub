from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import Select
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

    email.send_keys("amel@gmail.com")  # Remplace avec un compte valide
    password.send_keys("amel123")  # Remplace avec le bon mot de passe
    password.send_keys(Keys.RETURN)

    # Attendre la redirection vers la page de profil
    wait.until(EC.url_contains("/profil"))
    print("✅ Connexion réussie !")

    # 🟢 2. Aller sur la page de modification des vœux
    driver.get("http://127.0.0.1:8000/voeux/edit")
    print("Page de modification des vœux chargée.")

    # 🟢 3. Modifier les choix des listes déroulantes
    for i in range(1, 6):  # Boucle pour les 5 choix
        select_element = wait.until(EC.presence_of_element_located((By.NAME, f"voeux[projet_{i}]")))
        select = Select(select_element)
        wait.until(lambda d: len(select.options) > 1)  # Vérifier que les options sont chargées
        select.select_by_visible_text(f"Projet {i}")  # Sélectionne Projet 1, Projet 2, ..., Projet 5

    print("✅ Sélections des vœux mises à jour !")

    # 🟢 4. Cliquer sur le bouton "Mettre à jour mes vœux"
    update_button = wait.until(EC.element_to_be_clickable((By.CSS_SELECTOR, "button.btn.btn-primary")))
    driver.execute_script("arguments[0].click();", update_button)  # Force le clic

    # 🟢 5. Vérifier que la mise à jour est bien prise en compte
    confirmation_message = wait.until(EC.url_contains("/profil"))
    print("✅ Modification des vœux réussie !")

except Exception as e:
    print("❌ Erreur :", e)
    print("Page source :", driver.page_source)

finally:
    driver.quit()
