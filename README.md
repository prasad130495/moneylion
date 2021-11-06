# MoneyLion Technical Assesment

1. Requirement is to create a GET/POST that can provide or amend information on user features.
2. GET requests uses email and featureName as request parameters/arguments:
	 GET /feature?email=XXX&featureName=XXX
3. POST requests do not use any arguments other than JSON data such as the following as part of the content
	Example:
	{
	"featureName": "xxx", (string)
	"email": "xxx", (string) (user's name)
	"enable": true|false (boolean) (uses true to enable a user's access, otherwise
	}

# Step by Step:
### Creation of MySQL database
1. A database was created in my website with the following data:
	Database table name: FeatureTable
	Columns: Email (string), Feature1(bit)
	Subsequently we can add more columns, where each column becomes one feature, the bit value in the column basically means the enablement of the feature for the user (email). For instance, table below shows the user do not have access to Feature1 due to value 0:

| Email                                    | Feature1   |
| prasad130495@gmail.com |              0   |

2. All SQL information alteration and insertion can be found in sql.txt in this repository.

### Creation of db.php for database access.
1. As soon as database is created we need to access the database for amendments or information retrieval.
2. We will use mysqli feature in php to do that, providing username, databasename, and password. For more information, refer to db.php file.
3. This script also needs to have failsafe to prevent direct access through URL, therefore a constant is defined and checked if true before making connection through sqli library

### Creation of feature.php that will act as API endpoint handling GET/POST request
1. Handling GET/POST differently.
2. GET request relies on URL arguments such as email and featureName to be provided.
3. POST request relies on JSON input as body.


FOR FUNCTIONAL TESTING, PLEASE MAKE USE OF THE FOLLOWING LINK.
https://prasaddev.com/moneylion/feature.php

You may use online REST API testing tools such as the following:
https://reqbin.com/

	
#### GET Request Example:
https://prasaddev.com/moneylion/feature.php?email=prasad130495@gmail.com&&featureName=Feature1
![image](https://user-images.githubusercontent.com/34993717/140591003-3933019f-803b-4bdf-bbdd-c63e12a6ddd9.png)


#### POST Request Example:
https://prasaddev.com/moneylion/feature.php

{
"FeatureName": "Feature1",
"email":"prasad130495@gmail.com",
"enable":"true"
}

![image](https://user-images.githubusercontent.com/34993717/140591035-62c8af77-702a-4a38-ab45-8c0b2c1579a9.png)

#### POST Request if input is not valid:

{
"FeatureName": "",
"email":"prasad130495@gmail.com",
"enable":""
}

![image](https://user-images.githubusercontent.com/34993717/140591055-baaac3e4-2a2a-45ad-831c-e41efcec95ea.png)

	
	
