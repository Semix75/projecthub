from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC

# Configuration du navigateur
options = webdriver.ChromeOptions()
# options.add_argument("--headless")  # Désactive "headless" pour voir le test en direct
driver = webdriver.Chrome(options=options)

try:
    # Ouvre la page d'inscription
    driver.get("http://127.0.0.1:8000/register")
    print("Page chargée :", driver.current_url)

    wait = WebDriverWait(driver, 10)

    # Sélection des champs du formulaire
    firstname = wait.until(EC.presence_of_element_located((By.NAME, "registration_form[firstname]")))
    lastname = wait.until(EC.presence_of_element_located((By.NAME, "registration_form[lastname]")))
    username = wait.until(EC.presence_of_element_located((By.NAME, "registration_form[username]")))
    email = wait.until(EC.presence_of_element_located((By.NAME, "registration_form[email]")))
    password = wait.until(EC.presence_of_element_located((By.NAME, "registration_form[plainPassword]")))
    agree_terms = wait.until(EC.presence_of_element_located((By.NAME, "registration_form[agreeTerms]")))

    # Remplir le formulaire
    firstname.send_keys("Amel")
    lastname.send_keys("Dupont")
    username.send_keys("ameldupont")
    email.send_keys("amel.dupont@example.com")
    password.send_keys("Motdepasse123")
    agree_terms.click()  # Cocher la case obligatoire

    print("Formulaire rempli, soumission en cours...")

    # Soumission du formulaire
    password.send_keys(Keys.RETURN)

    # Attendre la redirection après l'inscription
    wait.until(EC.url_changes("http://127.0.0.1:8000/register"))
    print("URL après inscription :", driver.current_url)

    # Vérifier que l'inscription a réussi
    assert "Mon Profil" in driver.page_source
    print("✅ Inscription réussie !")

except Exception as e:
    print("❌ Erreur détectée :", e)
    print("Page source :", driver.page_source)

finally:
    driver.quit()
