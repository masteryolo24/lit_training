from bs4 import BeautifulSoup
from selenium.webdriver import Chrome


# BASE ON JIMDO
# image url

url = 'https://golsonsonline.com/outdoor-kitchens-360/shop-by-grill-type/built-in-grills-369/fire-magic-black-diamond-edition-grill-with-magic-view-window-h790i-4e1n-w.html'

# driver.manage().window().maximize();
# driver.manage().timeouts().implicitlyWait(60, TimeUnit.SECONDS);
# driver.findElement(By.id("identifierId")).sendKeys("your email", Keys.ENTER);

browser = Chrome()
browser.get(url)
content = browser.page_source
b_content = BeautifulSoup(content)
get_image_tag = b_content.findAll('img')
get_description_tag = b_content.findAll('div', {'class':'description'}, limit=1)
get_product_gallery_image = b_content.findAll('div', {'class' : 'product-full'}, limit=1)
print(get_product_gallery_image)
browser.close()