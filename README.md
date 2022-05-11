# Financial Management System - New Legazpi Tong Hua Trading
## About
- This is the Github repository for the Financial Management System of New Legazpi Tong Hua Trading.

## Requirements
- [XAMMP] -  Apache distribution containing MariaDB, PHP, and Perl (Download version 7.4.29). 
- [VS Code] or any other advanced text editor.
- Any browser (as long as it is updated to its latest version).

## Database Tables
- **chart_of_accounts**
    - chart_of_accounts_id - The account id (e.g. 1000 for Cash)
    - chart_of_accounts_name - The account name (e.g. Cash, Inventory, Accounts Payable)
    - chart_of_accounts_type - The type of the account (e.g. Asset, Liability, Owners Equity)
- **journal_entry**
    -  journal_entry_posting_id - The posting id of the transaction (e.g. PS-000001)
    -  journal_entry_date - The date of the transaction (e.g. 2022-12-31)
    -  journal_entry_id - The journal id of the transaction (e.g. JE-000001)
    -  journal_entry_account_id - The account id involved in the transaction (e.g. 1000 -> Cash)
    -  journal_entry_account_amount - The amount involved in the transaction
    -  journal_entry_description - The description or explanation of the transaction

[//]: # (These are reference links used in the body of this note and get stripped out when the markdown processor does its job. There is no need to format nicely because it shouldn't be seen. Thanks SO - http://stackoverflow.com/questions/4823468/store-comments-in-markdown-syntax)

   [XAMMP]: <https://www.apachefriends.org/download.html>
   [VS Code]: https://code.visualstudio.com/
   [john gruber]: <http://daringfireball.net>
   [df1]: <http://daringfireball.net/projects/markdown/>
   [markdown-it]: <https://github.com/markdown-it/markdown-it>
   [Ace Editor]: <http://ace.ajax.org>
   [node.js]: <http://nodejs.org>
   [Twitter Bootstrap]: <http://twitter.github.com/bootstrap/>
   [jQuery]: <http://jquery.com>
   [@tjholowaychuk]: <http://twitter.com/tjholowaychuk>
   [express]: <http://expressjs.com>
   [AngularJS]: <http://angularjs.org>
   [Gulp]: <http://gulpjs.com>

   [PlDb]: <https://github.com/joemccann/dillinger/tree/master/plugins/dropbox/README.md>
   [PlGh]: <https://github.com/joemccann/dillinger/tree/master/plugins/github/README.md>
   [PlGd]: <https://github.com/joemccann/dillinger/tree/master/plugins/googledrive/README.md>
   [PlOd]: <https://github.com/joemccann/dillinger/tree/master/plugins/onedrive/README.md>
   [PlMe]: <https://github.com/joemccann/dillinger/tree/master/plugins/medium/README.md>
   [PlGa]: <https://github.com/RahulHP/dillinger/blob/master/plugins/googleanalytics/README.md>
