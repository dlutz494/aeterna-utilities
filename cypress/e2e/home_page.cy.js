describe('The Home Page', () => {
    it('tries google', () => {
        cy.visit('https://www.google.com')
    });
    it('tries port 8000', () => {
        cy.visit('http://127.0.0.1:8000')
    });

    it('displays the header', () => {
        cy.visit('/');

        cy.get('#site-header').should('contain.text', 'Home');
    });
    it('displays the footer', () => {
        cy.visit('/');

        cy.get('#site-footer').should('contain', '2024 David Lutz');
    });
    it('displays the navbar', () => {
        cy.visit('/');

        cy.get('#nav-home').should('contain.text', 'Home');
        cy.get('#nav-generator').should('contain.text', 'Generator');
        cy.get('#nav-admin').should('contain.text', 'Admin Panel');
        cy.get('#theme-toggle').should('contain.text', 'Toggle Theme:');
    });
    it('displays the main menu', () => {
        cy.visit('/');

        cy.get('#generator').should('contain.text', 'Encounter Generator');
        cy.get('#admin').should('contain.text', 'Admin Panel');
    })
});
