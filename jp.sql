-- Insert sample data for admin table
INSERT INTO `admin` (`adminId`, `userId`, `role`) VALUES
(1, 5, 'Administrator');

-- Insert sample data for event table
INSERT INTO `event` (`eventId`, `eventName`, `eventType`, `eventDescription`, `eventDate`, `eventVenue`, `noOfGuests`, `adminId`) VALUES
(1, 'Annual Gala Dinner', 'Corporate', 'Exclusive gala dinner for corporate executives', '2024-11-25', 'Shangri-La Hotel, Colombo', 200, 1),
(2, 'Charity Concert', 'Music', 'Fundraising concert for a local charity', '2024-12-15', 'Nelum Pokuna Theater', 800, 1);

-- Insert sample data for feedback table
INSERT INTO `feedback` (`feedbackId`, `userId`, `rating`, `comments`, `createdAt`, `user_id`) VALUES
(1, 1, 5, 'Amazing service!', '2024-10-18 10:30:00', 1),
(2, 2, 4, 'Great experience overall.', '2024-10-18 11:00:00', 2);

-- Insert sample data for notifications table
INSERT INTO `notifications` (`notificationId`, `userId`, `message`, `createdAt`, `isRead`, `serviceProviderId`, `adminId`) VALUES
(1, 1, 'Your event has been approved', '2024-10-18 09:00:00', 0, NULL, 1),
(2, 2, 'Your service has been rejected', '2024-10-18 09:30:00', 0, NULL, 1);

-- Insert sample data for packages table
INSERT INTO `packages` (`packageId`, `packageName`, `packageDetails`, `serviceProviderId`, `packagePrice`) VALUES
(1, 'Premium Wedding Package', 'Includes venue, catering, and decorations', 18, 150000.00),
(2, 'Basic Corporate Package', 'Venue and refreshments for up to 100 guests', 19, 50000.00);

-- Insert sample data for payment table
INSERT INTO `payment` (`paymentId`, `paymentDate`, `paymentMethod`, `userId`, `packageId`, `amount`, `advanceAmount`, `dueAmount`, `first_name`, `last_name`, `email`, `city`, `zip_code`, `card_name`, `card_number`, `exp_month`, `exp_year`, `cvv`, `status`, `otp`) VALUES
(1, '2024-10-18', 'Card', 1, 1, 150000, 50000, 100000, 'John', 'Doe', 'john@example.com', 'Colombo', '12345', 'John Doe', '1111222233334444', '12', '2025', '123', 'Pending', '123456');

-- Insert sample data for registereduser table
INSERT INTO `registereduser` (`userId`, `contactNumber`, `address`, `NICNumber`, `NICFrontPhoto`, `NICBackPhoto`) VALUES
(1, '0771234567', 'No. 123, Colombo 5', '123456789V', 'front.jpg', 'back.jpg'),
(2, '0712345678', 'No. 456, Kandy', '987654321V', 'front2.jpg', 'back2.jpg');

-- Insert sample data for serviceprovider table
INSERT INTO `serviceprovider` (`providerId`, `userId`, `providerName`, `contactInfo`, `serviceDetails`, `status`) VALUES
(1, 2, 'Floral Decorations', '0712345678', 'Providing beautiful floral decorations for weddings', 'approved'),
(2, 3, 'Catering Services', '0771234567', 'Offering catering services for events', 'approved');

-- Insert sample data for services table
INSERT INTO `services` (`serviceId`, `userId`, `serviceName`, `serviceDescription`, `status`) VALUES
(1, 2, 'Wedding Florist', 'Flower arrangements for weddings and receptions', 'approved'),
(2, 3, 'Event Catering', 'Full catering service for events', 'approved');

-- Insert sample data for user table
INSERT INTO `user` (`userId`, `username`, `password`, `email`, `userType`, `profilePicture`, `created_at`, `updated_at`, `status`) VALUES
(1, 'john_doe', '$2y$10$xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 'john.doe@example.com', 'registered', NULL, '2024-10-18 08:00:00', '2024-10-18 08:00:00', 'approved'),
(2, 'jane_smith', '$2y$10$yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy', 'jane.smith@example.com', 'serviceProvider', NULL, '2024-10-18 09:00:00', '2024-10-18 09:00:00', 'approved');

-- Insert sample data for usereventbooking table
INSERT INTO `usereventbooking` (`bookingId`, `userId`, `eventId`, `bookingDate`) VALUES
(1, 1, 1, '2024-11-01'),
(2, 2, 2, '2024-12-01');
