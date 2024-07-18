describe('The Admin Panel', () => {
    beforeEach(() => {
        cy.visit('/admin');
    });

    it('displays the header title', () => {
        cy.getBySel('site-header').should('contain.text', 'Admin');
    });

    it('displays the admin menu', () => {
        cy.getBySel('encounters-link').should('contain.text', 'Encounters');
        cy.getBySel('contexts-link').should('contain.text', 'Contexts');
    });

    it('navigates to encounter index', () => {
        cy.getBySel('encounters-link').click();
        cy.url().should('equal', Cypress.config().baseUrl + '/encounters');
    });

    it('navigates to context index', () => {
        cy.getBySel('contexts-link').click();
        cy.url().should('equal', Cypress.config().baseUrl + '/contexts');
    })
});
