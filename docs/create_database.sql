CREATE TABLE users(
    email VARCHAR(50) NOT NULL,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    pwd LONGTEXT NOT NULL,

    PRIMARY KEY (email)
);

CREATE TABLE projects(
    project_id int(11) NOT NULL AUTO_INCREMENT,
    project_name VARCHAR(50),
    project_start_date date,
    owner_email VARCHAR(50) NOT NULL,

    PRIMARY KEY (project_id),
    FOREIGN KEY (owner_email) REFERENCES users(email)
);

CREATE TABLE favorites(
    project_id int(11) NOT NULL,
    user_email VARCHAR(50) NOT NULL,

    PRIMARY KEY(project_id, user_email),
    FOREIGN KEY (project_id) REFERENCES projects(project_id),
    FOREIGN KEY (user_email) REFERENCES users(email)
);

CREATE TABLE intents(
    title VARCHAR(50) NOT NULL,
    project_id int(11) NOT NULL,

    PRIMARY KEY(title, project_id),
    FOREIGN KEY (project_id) REFERENCES projects(project_id)
);

CREATE TABLE tasks(
    title VARCHAR(50) NOT NULL,
    task_description VARCHAR(100),
    task_start_date date,
    task_due_date date,
    task_finish_date date,
    task_percentage int(3),
    intent_title VARCHAR(50) NOT NULL,
    project_id int(11) NOT NULL,

    PRIMARY KEY(title, intent_title, project_id),
    FOREIGN KEY (intent_title, project_id) REFERENCES intents(title, project_id)
);

CREATE TABLE assigned_to(
    user_email VARCHAR(50) NOT NULL,
    project_id int(11) NOT NULL,
    intent_title VARCHAR(50) NOT NULL,
    task_title VARCHAR(50) NOT NULL,

    PRIMARY KEY(user_email, project_id, intent_title, task_title),
    FOREIGN KEY(user_email) REFERENCES users(email),
    FOREIGN KEY(intent_title,project_id) REFERENCES tasks(intent_title,project_id)
);

CREATE TABLE teams(
    team_id int(11) NOT NULL AUTO_INCREMENT,
    team_name VARCHAR(50),
    team_description VARCHAR(50),
    leader_email VARCHAR(50) NOT NULL,

    PRIMARY KEY (team_id),
    FOREIGN KEY (leader_email) REFERENCES users(email)
);


CREATE TABLE belongs_to(
    user_email VARCHAR(50) NOT NULL,
    team_id int(11) NOT NULL,
    
    PRIMARY KEY (user_email, team_id),
    FOREIGN KEY (user_email) REFERENCES users(email),
    FOREIGN KEY (team_id) REFERENCES teams(team_id)
);

CREATE TABLE appointed_to(
    team_id int(11) NOT NULL,
    project_id int(11) NOT NULL,
    
    PRIMARY KEY (team_id, project_id),
    FOREIGN KEY (team_id) REFERENCES teams(team_id),
    FOREIGN KEY (project_id) REFERENCES projects(project_id)
);