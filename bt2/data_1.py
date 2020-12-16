from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from bs4 import BeautifulSoup
import requests

url = "http://45.79.43.178/source_carts/wordpress/wp-admin/"
driver = webdriver.Firefox()
driver.get(url)

u = driver.find_element_by_name('log')
u.send_keys('admin')
p = driver.find_element_by_name('pwd')
p.send_keys('123456aA')
p.send_keys(Keys.RETURN)

url = 'http://45.79.43.178/source_carts/wordpress/wp-login.php'
values = {'log': 'admin',
          'pwd': '123456aA'}

r = requests.post(url, data=values)

soup = BeautifulSoup(str(r.text))
find = soup.select("span.display-name:nth-child(1)")
print(find[0].text)