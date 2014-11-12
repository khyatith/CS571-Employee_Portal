CS571-Employee_Portal
=====================
This website is used for managing the business side of the bakery.
This website  includes the following general capabilities:
A login page for employees that establishes a logon session variable in PHP to keep track of the user. This logon session variable times out - for security reasons.There are 3 types of employees: (1) administrators that can only create, modify, and delete user IDs and passwords, (2) managers that only view reports, and (3) sales managers that can add, modfy, and delete, products and product categoreis.

The pages in the website are :
An administrative login page (for all employees) - with session variables to track them appropriately. This is to time out.
A set of pages that allow for the management of products-cakes in my cakes, product categories, special sales, users, and administrators. This means sales manager is able to add, change, or remove any of these five types of data. 
A set of reports so the managers in the company can view any of the data in the database. Managers can't be trusted to actually change anything, but they are to be able to view any data in any of the tables. They are also allowed search options. The manager is to be able to specify any, or all, of the search criteria. For example, a manager might want to see all the products in a product category that have a price between $50 and $100.
For products: product price range, product name, product category
For employees: by type of employee, pay range
For special sales: product price range, product name, product category, sale start date, sale end date.
Search functionality is implemented using AJAX

There are four different product categories. Each product category contains at least four products.
Special sales are products that have been discounted. The special sales table does not to contain product information details other than a numeric product ID. This table is just to contain the new information that is needed to identify a product that has a special sales price. Special sales products are discounted by some percentage. In addition, special sales have a specified start date and a specified end date.

Employee data is to contain at least the following data: user ID, password, first name, last name, age, employee type,address and contact.

Technologies used : PHP,JAVASCRIPT,MYSQL,HTML,CSS, AJAX
