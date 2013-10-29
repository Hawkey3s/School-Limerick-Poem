1. copy every files into server root folder. (so when go to localhost the index.php should load up).


2. make necessary changes in config/create.php and make sure that there's no database name "looney" exist in your database.


3. run localhost/config/create.php, you should get "Tables have been created!".


4. now that the database and tables have been created, 
   make changes in setup.php, and variable $link in function addPoem() of poem_model.php to the correct mysql connection information.


5. you should be good now, if you want to make things easily you can import the looney.sql file in config folder, it contains database with few poems added.



*Important, when adding new poem, please make sure to have no space after the last word of each line or else it will fail.




Poems that work


1.

There once was a lad from the south;

Who rarely opened his mouth.

And when he did

Everyone hid

And cried ‘Good lord, close your mouth!



2.

There was a young rustic named Mallory

who drew but a very small salary

When he went to the show

his purse made him go

to a seat in the uppermost gallery



3.

My dog is quite hip

Except when he takes a dip

He looks like a fool

when he jumps in the pool

and reminds me of a sinking ship