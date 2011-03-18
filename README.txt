sones GraphDSPHPClient

Simple php client library to talk with a sones GraphDB - enterprise graph database management system.

Documentation:

For API Documentation see phpdoc in doc folder.
For GQL Syntax see documentation at sones Developer-Wiki (http://developers.sones.de/)

History:

2011-03-17 (initial release) by Michael Schilonka

	Features
		- simple connection to a graphDB REST service based on given URI and credentials
		- possibility to easily send GQL-Queries to the service
		- parsing methods to create a QueryResult out of the XML-Response 
		- API to handle vertices, edges and some result meta data
		- take one client to one instance of sones GraphDB Service
		
	DemoExample
		- simple php-pages to demonstrate the lib
		- use with the open source version 1.1, cause of the default port and credentials 
		- easy to use output, queryresult: left - codefragment:right
		- every code references are in the output 
		Notice: - set "max_execution_time" to false (max_execution_time = false) in php.ini
			  because creating demo database takes a while
		
	
	Missing functionality
		General
			- BasicTypes of C# are not supported, cause of php

		IVertex
			- anonymous functions
			- traverse methods
			- link/unlink
		
		GraphDSClient
			- QueryResultActions
			
		ObjectRevisionID
			- The pattern doesn't exactly parse the timestamp (GraphDB uses C# DateTime.ParseExact()-Method with 7 most significant digits of seconds fraction)
	
	
	Warnings
		- there are some warnings cause of the "Include_once..." 

