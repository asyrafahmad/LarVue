
let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default;
let forget = require('./components/auth/forget.vue').default;
let logout = require('./components/auth/logout.vue').default;

// End Authentication
let home = require('./components/home.vue').default;

// Employee component
let storeEmployee = require('./components/employee/create.vue').default;
let employee = require('./components/employee/index.vue').default;
let editEmployee = require('./components/employee/edit.vue').default;

// Supplier component
let storeSupplier = require('./components/supplier/create.vue').default;
let supplier = require('./components/supplier/index.vue').default;
let editSupplier = require('./components/supplier/edit.vue').default;

// Category component
let storeCategory = require('./components/category/create.vue').default;
let category = require('./components/category/index.vue').default;
let editCategory = require('./components/category/edit.vue').default;

// Product component
let storeProduct = require('./components/product/create.vue').default;
let product = require('./components/product/index.vue').default;
let editProduct = require('./components/product/edit.vue').default;

// Expense component
let storeExpense = require('./components/expense/create.vue').default;
let expense = require('./components/expense/expense.vue').default;
let editExpense = require('./components/expense/edit.vue').default;

// Salary component
let salary = require('./components/salary/all_employee.vue').default;
let paySalary = require('./components/salary/create.vue').default;
let allSalary = require('./components/salary/index.vue').default;
let viewSalary = require('./components/salary/view.vue').default;
let editSalary = require('./components/salary/edit.vue').default;

// Stock component
let stock = require('./components/product/stock.vue').default;
let editStock = require('./components/product/edit-stock.vue').default;


export const routes = [
    { path: '/', component: login, name: '/'},
    { path: '/register', component: register, name: 'register'},
    { path: '/forget', component: forget, name: 'forget'},
    { path: '/logout', component: logout, name: 'logout'},
    { path: '/home', component: home, name: 'home'},

    //Employee routes
    { path: '/store-employee', component: storeEmployee, name: 'store-employee'},
    { path: '/employee', component: employee, name: 'employee'},
    { path: '/edit-employee/:id', component: editEmployee, name: 'edit-employee'},

    //Supplier routes
    { path: '/store-supplier', component: storeSupplier, name: 'store-supplier'},
    { path: '/supplier', component: supplier, name: 'supplier'},
    { path: '/edit-supplier/:id', component: editSupplier, name: 'edit-supplier'},

    //Category routes
    { path: '/store-category', component: storeCategory, name: 'store-category'},
    { path: '/category', component: category, name: 'category'},
    { path: '/edit-category/:id', component: editCategory, name: 'edit-category'},

    //Product routes
    { path: '/store-product', component: storeProduct, name: 'store-product'},
    { path: '/product', component: product, name: 'product'},
    { path: '/edit-product/:id', component: editProduct, name: 'edit-product'},
    
    //Expense routes
    { path: '/store-expense', component: storeExpense, name: 'store-expense'},
    { path: '/expense', component: expense, name: 'expense'},
    { path: '/edit-expense/:id', component: editExpense, name: 'edit-expense'},
  
    //Salary routes
    { path: '/given-salary', component: salary, name: 'given-salary'},
    { path: '/pay-salary/:id', component: paySalary, name: 'pay-salary'},
    { path: '/salary', component: allSalary, name: 'salary'},
    { path: '/view-salary/:id', component: viewSalary, name: 'view-salary'},
    { path: '/edit-salary/:id', component: editSalary, name: 'edit-salary'},

    //Stock routes
    { path: '/stock', component: stock, name: 'stock'},
    { path: '/edit-stock/:id', component: editStock, name: 'edit-stock'},
]