from selenium import webdriver
from selenium.webdriver.chrome.options import Options
import time
def get_data(type_entity = 'products'):
	chrome_options = Options()
	chrome_options.add_argument("--incognito")
	driver = webdriver.Chrome(chrome_options=chrome_options, executable_path="/usr/local/bin/chromedriver")
	url = "https://noodlefirm.myshopify.com/admin"
	user = "info@teeshoppen.dk"
	_pass = "Tee&support!"
	driver.get(url)
	time.sleep(3)
	username = driver.find_element_by_name("account[email]")
	username.send_keys(user)
	next_button = driver.find_element_by_name('commit')
	next_button.click()
	time.sleep(2)
	password = driver.find_element_by_name("account[password]")
	password.send_keys(_pass)
	log_in = driver.find_element_by_name('commit')
	log_in.click()

	cookies_list = driver.get_cookies()
	url = 'https://noodlefirm.myshopify.com/admin/api/2020-10/' + type_entity +'.json'
	driver.get(url)
	product = driver.page_source
	time.sleep(10)
get_data('products')


