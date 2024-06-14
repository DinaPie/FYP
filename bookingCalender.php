<?php
class BookingCalendar extends Calendar {
    private $bookedDates = array(); // Array to store booked dates
    
    // Constructor
    public function __construct() {
        parent::__construct();
        // Retrieve booked dates from database
        $this->retrieveBookedDatesFromDatabase();
    }
    
    // Method to retrieve booked dates from the database
    private function retrieveBookedDatesFromDatabase() {
        // Assuming you have a database connection established
        // Replace 'your_db_host', 'your_db_name', 'your_db_user', 'your_db_password' with your actual database credentials
        $db_host = 'your_db_host';
        $db_name = 'your_db_name';
        $db_user = 'your_db_user';
        $db_password = 'your_db_password';
        
        try {
            $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $stmt = $conn->prepare("SELECT date FROM booked_dates");
            $stmt->execute();
            
            // Fetch all booked dates
            $this->bookedDates = $stmt->fetchAll(PDO::FETCH_COLUMN);
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
    
    // Override _showDay method to customize date cells
    private function _showDay($cellNumber) {
        $cellContent = null;
        $cellDate = date('Y-m-d',strtotime($this->currentYear.'-'.$this->currentMonth.'-'.($cellNumber)));
        
        if ($this->currentDay == 0) {
            $firstDayOfTheWeek = date('N',strtotime($this->currentYear.'-'.$this->currentMonth.'-01'));
            if (intval($cellNumber) == intval($firstDayOfTheWeek)) {
                $this->currentDay = 1;
            }
        }
        
        if (($this->currentDay != 0) && ($this->currentDay <= $this->daysInMonth)) {
            $this->currentDate = date('Y-m-d',strtotime($this->currentYear.'-'.$this->currentMonth.'-'.($this->currentDay)));
            $cellContent = $this->currentDay;
            $this->currentDay++;
        }
        
        // Check if the date is booked
        if (in_array($cellDate, $this->bookedDates)) {
            return '<li class="booked">'.$cellContent.'</li>';
        } else {
            // Check if the date is in the past
            if (strtotime($cellDate) < strtotime(date('Y-m-d'))) {
                return '<li class="past">'.$cellContent.'</li>';
            } else {
                return '<li class="available">'.$cellContent.'</li>';
            }
        }
    }
}

// Instantiate the booking calendar
$bookingCalendar = new BookingCalendar();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Booking Calendar</title>
    <link rel="stylesheet" type="text/css" href="calendar_styles.css">
</head>
<body>
    <?php echo $bookingCalendar->show(); ?>
</body>
</html>
