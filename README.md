[![CC BY-NC-SA 4.0][cc-by-nc-sa-shield]][cc-by-nc-sa]  
 
This work is licensed under a  
[Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License][cc-by-nc-sa].  
 
[![CC BY-NC-SA 4.0][cc-by-nc-sa-image]][cc-by-nc-sa]  
 
[cc-by-nc-sa]: http://creativecommons.org/licenses/by-nc-sa/4.0/  
[cc-by-nc-sa-image]: https://licensebuttons.net/l/by-nc-sa/4.0/88x31.png  
[cc-by-nc-sa-shield]: https://img.shields.io/badge/License-CC%20BY--NC--SA%204.0-lightgrey.svg  
 
# Graf-Cedric.de  
 
Graf-Cedric.de is a personal website dedicated to showcasing the games, hardware, and software tested by Cedric, a passionate beta tester. This site serves as a portfolio and provides insights into Cedric's testing experiences, along with detailed information about each item tested.
 
## Installation  
 
To run this project locally, follow these steps:  
 
1. **Clone the repository**:  
   ```bash  
   git clone https://github.com/newtox/graf-cedric.de.git  
   cd graf-cedric.de  
   ```  
 
2. **Install dependencies**:  
   Make sure you have Composer installed, then run:  
   ```bash  
   composer install  
   ```  
 
3. **Set up your environment file**:  
   Copy the `.env.example` file to `.env`:  
   ```bash  
   cp .env.example .env  
   ```  
 
4. **Generate the application key**:  
   ```bash  
   php artisan key:generate  
   ```  
 
5. **Configure the database**:  
   Update the `.env` file with your database credentials:  
   ```plaintext  
   DB_CONNECTION=mysql  
   DB_HOST=127.0.0.1  
   DB_PORT=3306  
   DB_DATABASE=your_database_name  
   DB_USERNAME=your_database_user  
   DB_PASSWORD=your_database_password  
   ```  
 
6. **Run migrations**:  
   ```bash  
   php artisan migrate  
   ```  
 
7. **Serve the application**:  
   ```bash  
   php artisan serve  
   ```  
   You can access the application at `http://localhost:8000`.  
 
## Usage  
 
- Navigate through the website to explore the different categories of games, hardware, and software tested by Cedric.  
- Click on any item for more detailed information.
 
## License  
 
This work is licensed under a  
[Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License][cc-by-nc-sa].  

## Contact

Found a bug?

- Open an issue directly on GitHub.
- Or reach out to me at [contact@placeholder.de](mailto:contact@placeholder.de)
