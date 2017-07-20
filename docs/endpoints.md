# List of Endpoints
====================

Campaigns
---------

 - campaigns/list
   the current options are:
    - date
      - start: starting date to fetch the campaigns
      - end: ending date to fetch the campaigns
    - list: list of the users into DoctorSender (equivalent to user_list)
    - limit: maximum number of campaigns to return
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

Users
-----
 - create
   - string name
     - Name of the list, it is mandatory and sensible to case.
   - array user
     - Array of the user information
     - It must contains a key email.

All the endpoints accept options.
The call returns an Array with the result.
