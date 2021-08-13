# Simple-Rest-Api-in-CI-3

###REST API IN CI -3 With Header Validation

## Database Name

Database: `codeigniter-api-application`


#Table structure for table `users`

````
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

`````
