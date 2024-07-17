describe('The Home Page', () => {
    beforeEach(() => {
        cy.visit('/');
    });

    it('displays the main menu', () => {
        cy.getBySel('generator-link').should('contain.text', 'Encounter Generator');
        cy.getBySel('admin-panel-link').should('contain.text', 'Admin Panel');
    });

    it('can navigate to encounter generator', () => {
        cy.getBySel('generator-link').click();
        cy.url().should('contain', '/generator');
    });

    it('can navigate to admin panel', () => {
        cy.getBySel('admin-panel-link').click();
        cy.url().should('contain', '/admin');
    });

    it('displays the header title', () => {
        cy.getBySel('site-header').should('contain.text', 'Home');
    });
});
