describe('The Default Layout', () => {
    beforeEach(() => {
        cy.visit('/');
    });

    it('displays the header', () => {
        cy.get('[data-cy="site-header"]').should('contain.text', 'Home');
    });

    it('displays the footer', () => {
        cy.get('[data-cy="site-footer"]').should('contain', '2024 David Lutz');
    });

    it('displays the navbar', () => {
        cy.get('[data-cy="nav-home"]').should('contain.text', 'Home');
        cy.get('[data-cy="nav-generator"]').should('contain.text', 'Generator');
        cy.get('[data-cy="nav-admin"]').should('contain.text', 'Admin Panel');
        cy.get('[data-cy="nav-theme-toggle"]').should('contain.text', 'Toggle Theme:');
    });
});
