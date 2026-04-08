from playwright.sync_api import sync_playwright

def main():
    with sync_playwright() as p:
        browser = p.chromium.launch(headless=False)

        context = browser.new_context(
            user_agent="Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 Chrome/120 Safari/537.36"
        )

        page = context.new_page()
        page.goto("https://www.tanitjobs.com/jobs/")

        page.wait_for_timeout(10000)

        print(page.title())

        browser.close()

main()