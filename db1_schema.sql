DROP TABLE IF EXISTS api_test1;

CREATE TABLE api_test1 (
  update_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,

  /* Project Details - Saved on click of Save button */            /* Status of the current task (can be either 'To Do', 'In Progress', 'Testing', or 'Completed') */
  update_text VARCHAR(4096),       /* Description of the activity */



  /* Record Tracking Information */
  created_by int(11) DEFAULT NULL,
  created_date datetime DEFAULT NULL,
  modified_by INT(11) DEFAULT NULL,                  /* Who modified the task */
  modified_date DATETIME DEFAULT NULL,               /* Date the task was updated/modified */
  deleted_by int(11) DEFAULT NULL,
  deleted_date datetime DEFAULT NULL
  );
