sones PHP GraphDB(v2.0) Client

Simple php client library to talk with a sones GraphDB(v2.0) - enterprise graph database management system.

Documentation:

For API Documentation see phpdoc in doc folder.
For GQL Syntax see documentation at sones Developer-Wiki (http://developers.sones.de/)

History:

2011-05-18 by Michael Schilonka

	Features
		- simple connection to a graphDB REST service based on given URI and credentials
		- possibility to easily send GQL-Queries to the service
		- parsing methods to create a QueryResult out of the XML-Response 
		- API to handle vertices, edges and some result meta data
		- take one client to one instance of sones GraphDB Service
		- compatibility to refactored xml output
		- validates the xml against schema
		
	Demo
		- simple php-pages to demonstrate the lib
		- use with the community edition 'version 2.0', cause of the default port and credentials 
		
			
	Warnings
		- there are some warnings cause of the "Include_once..." 

