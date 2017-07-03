# List of Endpoints
====================

Campaigns
---------

 - campaigns/list
 - campaigns/{id}
   - {id} is the ID of the Campaign.

Lists
-----
 - lists/list
   - boolean isTestList
     - optional 
     - default: true 
     - True if it is a Test List, False if its a Regular List 
 - lists/fields
   - string name
     - required
     - Name of the list, it is mandatory and sensible to case.
   - boolean isTestList
     - optional 
     - default: true 
     - True if it is a Test List, False if its a Regular List 
   - boolean getType
     - optional 
     - default: true 
     - True to get all the fields names, types and lengths, False to get only names and types

All the endpoints accept options.
The call returns an Array with the result.
