import mysql.connector
import pandas as pd
from mysql.connector import errorcode, MySQLConnection

data = pd.read_csv(r'customer.csv')

df = pd.DataFrame(data, columns = ['customerid', 'firstname','lastname' ,'companyname' ,'billingaddress1' ,'billingaddress2' ,'city' ,'state' ,'postalcode' ,'country' ,'phonenumber' ,'emailaddress' ,'createddate'])
df = df.where((pd.notnull(df)), None)
DB_NAME = 'data'

TABLE = {}
TABLE['customers'] = ("CREATE TABLE customers(customerid varchar(50) NOT NULL,firstname varchar(50) NOT NULL,lastname varchar(50),companyname varchar(50),billingaddress1 varchar(50),billingaddress2 varchar(50),city varchar(50),state varchar(50),postalcode varchar(50),country varchar(50),phonenumber varchar(50),emailaddress varchar(50),createddate varchar(50) NOT NULL)")


cnx = mysql.connector.connect(
  host="localhost",
  user="root",
  password="123456aA!"
)
cursor = cnx.cursor()

def create_database(cursor):
    try:
        cursor.execute(
            "CREATE DATABASE {} DEFAULT CHARACTER SET 'utf8'".format(DB_NAME))
    except mysql.connector.Error as err:
        print("Failed creating database: {}".format(err))
        exit(1)

try:
    cursor.execute("USE {}".format(DB_NAME))
except mysql.connector.Error as err:
    print("Database {} does not exists.".format(DB_NAME))
    if err.errno == errorcode.ER_BAD_DB_ERROR:
        create_database(cursor)
        print("Database {} created successfully.".format(DB_NAME))
        cnx.database = DB_NAME
    else:
        print(err)
        exit(1)


for table_name in TABLE:
    table_description = TABLE[table_name]
    try:
        print("Creating table {}: ".format(table_name), end='')
        cursor.execute(table_description)
    except mysql.connector.Error as err:
        if err.errno == errorcode.ER_TABLE_EXISTS_ERROR:
            print("already exists.")
        else:
            print(err.msg)
    else:
        print("OK")

for row in df.itertuples(index = False, name = 'Pandas'):
	cursor.execute("INSERT INTO customers (customerid, firstname, lastname ,companyname ,billingaddress1 ,billingaddress2 ,city ,state ,postalcode ,country ,phonenumber ,emailaddress ,createddate) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", row)
cnx.commit()
	

cursor.close()
cnx.close()