
<div align="center">
<a href="https://tiggomark.io"><img src="https://tiggomark.io/logos/tiggomark-logo-transparentBg-landscape-1500.png" alt="tiggomark Logo" width="300"/></a>

### tiggomark&trade; ###
tiggomark is a lean open source project management system for startups and innovators. <br />It's an alternative to ClickUp, Notion, and Asana.<br />[https://tiggomark.io](https://tiggomark.io)<br />

[![License Badge](https://img.shields.io/github/license/tiggomark/tiggomark?style=flat-square)](https://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
[![Version](https://img.shields.io/github/package-json/v/tiggomark/tiggomark/master?style=flat-square)](https://github.com/tiggomark/tiggomark/releases)
[![Docker Hub Badge](https://img.shields.io/docker/pulls/tiggomark/tiggomark?style=flat-square)](https://hub.docker.com/r/tiggomark/tiggomark)
[![Discord Badge](https://img.shields.io/discord/990001288026677318?label=Discord&style=flat-square)](https://discord.gg/4zMzJtAq9z)
[![Crowdin](https://badges.crowdin.net/tiggomark/localized.svg)](https://crowdin.com/project/tiggomark)
<br />

  ![alt text](public/images/Screenshots/ProjectDashboard.png "Dashboard")


</div>
<br /><br />

## Features: ##
* Task management using kanban boards, table and calendar views
* Idea boards & idea kanban boards
* Various research and strategy boards
* Milestone management using Gantt charts
* Timesheet management
* Manage goals
* Retrospectives
* Project dashboards
* Project reports
* Wikis with the ability to embed documents
* Multiple user roles
* Two-Factor Authentication
* LDAP integration
* Integrations with Mattermost, Slack, Zulip, Discord
* Export timesheets, tasks and milestones to CSV
* File storage with AWS S3 or local file system 
* Adjust color scheme and logo
* Available in 19 languages


### Screenshots ###

| ![alt text](public/images/Screenshots/UserDashboard.png "My Dashboard")   | ![alt text](public/images/Screenshots/ToDoKanban.png "Kanban Board") | ![alt text](public/images/Screenshots/ToDoTable.png "Grouped To-Dos") |
|---------------------------------------------------------------------|:--------------------------------------------------------------------:|:---------------------------------------------------------------------:|
| ![alt text](public/images/Screenshots/Timesheets.png "My Timesheets") | ![alt text](public/images/Screenshots/Milestones.png "Milestone Gantt Charts") |     ![alt text](public/images/Screenshots/Ideas.png "Idea Board")     |
| ![alt text](public/images/Screenshots/Goals.png "Calendar")      |  ![alt text](public/images/Screenshots/Strategy.png "Lean Canvas")   |  ![alt text](public/images/Screenshots/Reports.png "Report Screens")                                                                     |
| ![alt text](public/images/Screenshots/DocsEmbed.png "Documents")      |  ![alt text](public/images/Screenshots/Blueprints.png "Blueprints")   |  ![alt text](public/images/Screenshots/Confetti.png "Confetti")                                                                     |

### System Requirements ###

* PHP 8+
* MySQL 5.7+
* Apache or Nginx (IIS works with some modifications)

### Installation (Production) ###

* Download latest release package
* Create an empty MySQL database
* Upload entire directory to your server 
* Point your domain to the `public/` directory
* Rename `config/configuration.sample.php` to `config/configuration.php`
* Fill in your database credentials (username, password, host, dbname) in `config/configuration.php`
* Navigate to `<yourdomain.com>/install`
* Follow instructions to install database and set up first user account

### Installation (Development) ###

* Install composer and npm
* Clone repository to your local server
* Create MySQL database
* Run composer to load php dependencies
```
composer install
```
then
```
npm install
```
to load Javascript dependencies and finally run the grunt task to create the compiled js files
```
./node_modules/grunt/bin/grunt Build-All
```
* Point your local domain to the `public/` directory
* Rename `config/configuration.sample.php` to `config/configuration.php`
* Fill in your database credentials (username, password, host, dbname) in `config/configuration.php`
* Navigate to `<localdomain>/install`
* Follow instructions to install database and user account

### Installation via Docker ###

We maintain an official <a href="https://hub.docker.com/r/tiggomark/tiggomark">Docker image on dockerhub</a>. 
To run the image enter your MySQL credentials and execute

```
docker run -d --restart unless-stopped -p 80:80 --network tiggomark-net \
-e LEAN_DB_HOST=mysql_tiggomark \
-e LEAN_DB_USER=admin \
-e LEAN_DB_PASSWORD=321.qwerty \
-e LEAN_DB_DATABASE=tiggomark \
-e LEAN_EMAIL_RETURN=changeme@local.local \
--name tiggomark tiggomark/tiggomark:latest
```

You can set any of the config variables in `config/configuration.php` when running the docker command.

Once started you can go to `<yourdomain.com>/install` and run the installation script.

### Update ###

* Make sure to take a backup of your database and files
* Replace all files in your directory with the updated version
* If there were any database changes, the system will redirect your to `<yourdomain.com>/update`

## LICENSE Exceptions ##
This file forms part of the tiggomark Software for which the following exception is added: Plugins within the `/app/plugins` directory which merely make function calls to the tiggomark Software, and for that purpose include it by reference shall not be considered modifications of the software.

### Support ###
* Documentation [https://docs.tiggomark.io](https://docs.tiggomark.io)
* Community Forum [https://community.tiggomark.io](https://community.tiggomark.io)
* Discussions on [Discord](https://discord.gg/4zMzJtAq9z)
* File a bug report [https://github.com/tiggomark/tiggomark/issues/new](https://github.com/tiggomark/tiggomark/issues/new)
* Translations [https://crowdin.com/project/tiggomark](https://crowdin.com/project/tiggomark)
