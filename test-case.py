from selenium import webdriver
from selenium.webdriver.chrome.options import Options
import time

from selenium.webdriver.common.by import By
chrome_options = Options()
chrome_options.add_argument("--headless")
# driver = webdriver.Chrome()
# driver.get("https://crm.nayatel.com")
# time.sleep(5)


driver = webdriver.Chrome()
driver.get('https://crm.nayatel.com/nhrms/LoginController')
driver.find_element(By.NAME, 'username').send_keys('waqas.rafique')
elem = driver.find_element(By.NAME, 'password')
elem.send_keys('123456@wS')
time.sleep(1)
# elem.send_keys(Keys.RETURN)
driver.find_element(By.XPATH, '/html[1]/body[1]/div[1]/div[1]/div[1]/form[1]/fieldset[1]/div[4]/button[1]').click()

# Switch to the new window and open new URL
driver.execute_script("window.open('');")
driver.switch_to.window(driver.window_handles[1])
driver.get('https://crm.nayatel.com/views/crmViews/nayatelCrm/EventLoggerModule/event')
time.sleep(1)
print('Here')
assert 'Event Form' in driver.title