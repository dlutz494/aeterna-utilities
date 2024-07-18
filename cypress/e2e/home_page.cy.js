describe('The Home Page', () => {
    beforeEach(() => {
        cy.visit('/');
    });

    it('displays the header title', () => {
        cy.getBySel('site-header').should('contain.text', 'Home');
    });

    it('displays the main menu', () => {
        cy.getBySel('generator-link').should('contain.text', 'Encounter Generator');
        cy.getBySel('admin-panel-link').should('contain.text', 'Admin Panel');
    });

    it('can navigate to encounter generator', () => {
        cy.getBySel('generator-link').click();
        cy.url().should('equal', Cypress.config().baseUrl + '/generator');
    });

    it('can navigate to admin panel', () => {
        cy.getBySel('admin-panel-link').click();
        cy.url().should('equal', Cypress.config().baseUrl + '/admin');
    });
});
