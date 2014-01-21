 CREATE TABLE `meta` (
  `name` varchar(125) NOT NULL,
  `type` enum('image','audio','video') DEFAULT 'image',
  `dimensions` varchar(255) DEFAULT NULL,
  `hash` varchar(130) NOT NULL,
  `userId` int(11) NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mime` varchar(35) NOT NULL,
  UNIQUE KEY `jj` (`userId`,`hash`)
);
