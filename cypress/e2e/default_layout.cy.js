describe('The Default Layout', () => {
    beforeEach(() => {
        cy.visit('/');
    });

    it('displays the header', () => {
        cy.getBySel('site-header').should('contain.text', 'Home');
    });

    it('displays the footer', () => {
        cy.getBySel('site-footer').should('contain', '2024 David Lutz');
    });

    it('displays the navbar', () => {
        cy.getBySel('nav-home').should('contain.text', 'Home');
        cy.getBySel('nav-generator').should('contain.text', 'Generator');
        cy.getBySel('nav-admin').should('contain.text', 'Admin Panel');
        cy.getBySel('nav-theme-toggle').should('contain.text', 'Toggle Theme:');
    });

    it('navbar navigates to home', () => {
        cy.visit('/generator');
        cy.getBySel('nav-home').click();

        cy.url().should('equal', Cypress.config().baseUrl + '/');
    });

    it('navbar navigates to generator', () => {
        cy.getBySel('nav-generator').click();

        cy.url().should('equal', Cypress.config().baseUrl + '/generator');
    });

    it('navbar navigates to admin panel', () => {
        cy.getBySel('nav-admin').click();

        cy.url().should('equal', Cypress.config().baseUrl + '/admin');
    });

    it('toggles the theme', () => {
        cy.getBySel('nav-theme-toggle').should('contain.text', 'Toggle Theme: Dark');
        cy.getBySel('nav-theme-toggle').click();
        cy.getBySel('nav-theme-toggle').should('contain.text', 'Toggle Theme: Light');
        cy.getBySel('nav-theme-toggle').click();
        cy.getBySel('nav-theme-toggle').should('contain.text', 'Toggle Theme: Dark');
    });
});
