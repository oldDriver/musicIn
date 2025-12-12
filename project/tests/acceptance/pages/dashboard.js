const { I } = inject();

module.exports = {

    // insert your locators and methods here
    selectors: {
        dashboard: {css: 'div.panel-dashboard'},
        mainMenu: {css: 'div.sofi-mainmenu'}
    },
    checkElements() {
        I.seeElement(this.selectors.mainMenu);
        //I.seeElement(this.selectors.dashboard);
    },
    gotoDashboard() {

    },
    clickItem(item) {
        const page = this.helpers['Puppeteer'].page;
        page.evaluate(() => {
            const links = document.querySelectorAll('span.menu-item-content');
            links.forEach((link) => {
                if (link.innerHTML = item) {
                    link.click();
                }
            });
        });

    }
}