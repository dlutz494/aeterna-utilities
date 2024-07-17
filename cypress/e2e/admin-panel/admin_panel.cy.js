describe('The Admin Panel', () => {
    beforeEach(() => {
        cy.visit('/admin');
    });

    it('displays the header title', () => {
        cy.visit('/admin');

        cy.getBySel('site-header').should('contain.text', 'Admin');
    });

    it('displays the admin menu', () => {
        cy.visit('/admin');

        cy.getBySel('encounters-link').should('contain.text', 'Encounters');
        cy.getBySel('contexts-link').should('contain.text', 'Contexts');
    });
});
