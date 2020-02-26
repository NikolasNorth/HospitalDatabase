# Hospital Database

### Description

CRUD database web application keeping track of doctor-patient relationships, and the hospitals at which treatments occur.

### What This Application Can Do:

#### `getdoctorbyname.php`
- List all the doctor's first name and last name in alphabetical order. Allow the user to decide if the doctors name (either first or last) should be in ascending or descending order. 
- Once the list of doctors is displayed, allow the user to select one of the doctors to display more information including the name of the hospital that the doctor works at.

#### `listdocsbydate.php`
- List all the doctors (first name, last name, specialty and license date) who were licensed before a given date. Allow the user to enter the date.

#### `addnewdoctor.php`
- Allow the user to enter a new doctor. The user should be able to enter all the information including which hospital the doctor works at. 
- Ensure the user can't insert a doctor with a previously existing license number.

#### `deletedoctor.php` and `confirmdeletedoctor.php`
- Allow the user to delete an existing doctor. 
- Notify the user know if they try to delete a doctor who is treating patients and allow the to change their mind. 

#### `updatehospitalname.php`
- Allow the user to update a hospital's name. 

#### `listhospitalandheaddoctor.php`
- List all the hospital names, including the first and last name of the head doctor at each hospital.
- Include the doctor's start date as head, in alphabetical order by hospital name.

#### `searchpatientbyohip.php`
- Allow the user to select a patient by entering their OHIP number, then output the following information:
  - Patient's first and last name
  - All treating doctor's first and last name(s)
- Give an error message if the user enters an OHIP number that does not exist

#### `managepatient.php`
- Allow the user to assign a doctor to treat a patient
- Allow the user to cancel a treatment plan between a doctor and patient. 

#### `listdoctorwithoutpatients.php` 
- Output the first and last name of any doctor who has no patients. 
