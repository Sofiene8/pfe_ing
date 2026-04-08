import requests
from bs4 import BeautifulSoup
import csv

##date=input("please enter a Date")
page= requests.get("https://www.tanitjobs.com/jobs/")

def main(page):
    src=page.content
    soup=BeautifulSoup(src,"lxml")
    jobs_details = []
    jobs = soup.find_all("div",class_="css-1rzs9zm eu4oa1w0")
    print(jobs)

main(page)