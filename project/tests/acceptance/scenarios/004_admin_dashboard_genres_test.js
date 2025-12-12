Feature('Admin dashboard Genre');

Scenario('Genre dashboard test',  ({ I, dashboardPage}) => {
    I.logout();
    I.login('admin@musicin.test', 'password');
    I.waitUrlEquals('/admin');
    I.waitForElement('nav#main-menu');
    //dashboardPage.clickItem('Genres');
    // I.click('Genres', '.menu-item');
    //I.waitForElement('form.form-action-search input[name="query"]', 5);
    I.logout();
});
