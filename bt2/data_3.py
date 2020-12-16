import requests
import pandas as pd
url = "https://16ebfeb454afbd1dae57ccb28ae18d18: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@mrtranmr24.myshopify.com/admin/api/2020-10/customers.json"
r = requests.get(url)
data = pd.DataFrame(r.json()['customers'])
df = data.loc[ : , data.columns != 'addresses']
df.to_csv(r'file.csv', index = False)
