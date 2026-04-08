#Importing Libraries & Methods
from bs4 import BeautifulSoup as bs
from urllib.request import urlopen

# Inputting  the URL
url='https://wuzzuf.net/a/IT-Software-Development-Jobs-in-Egypt?ref=browse-jobs' 


#Create a Client-based Request to Get the URL
client= urlopen(url)

# Getting the HTML Code of the Full Page
html= client.read()

decoded = html.decode("utf-8")


#Closing the Request
client.close()
# Creating an HTML Parser Using BeautifulSoup
soup = bs(decoded , "html.parser")
 #Create a Container for the Needed Data
containers = soup.find_all('div',class_='css-ghe2tq e1v1l3u10')
#print(len(containers))
#print(bs.prettify(containers[0]))
#Accessing Page Elements
##jobTitle=containers[0].div.h2.text

#1.jobTitle
job_title=containers[0].findAll('h2',class_='css-193uk2c')
print(job_title[0].text)
#2.companyName
company_name= containers[0].findAll('a',class_='css-ipsyv7')
print(company_name[0].text)
#3.location
location= containers[0].findAll('span',class_='css-16x61xq')
print(location[0].text)
#4.date_posted
date_posted= containers[0].findAll('div',class_='css-eg55jf')
print(date_posted[0].text)
#5.employment_type
employment_type= containers[0].findAll('span',class_='css-uc9rga eoyjyou0')
print(employment_type[0].text)
#6.work_model
work_model= containers[0].findAll('span',class_='css-uofntu eoyjyou0')
print(work_model[0].text)
#7.seniority_level
seniority_level= containers[0].findAll('a',class_='css-o171kl')
print(seniority_level[0].text)
#8.experience_required
#experience_required= seniority_level.find_next_sibling('span')
#print(experience_required[0].text)
#8.skills
skills= containers[0].findAll('a',class_='css-o171kl')
print(skills[0].text)
