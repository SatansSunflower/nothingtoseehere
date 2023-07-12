# QuickLinks/Table of Contents
## CROSS JOIN

* returns all rows from both tables
* NO WHERE!
* inefficient af so **dont use it**

---

## INNER JOIN
* maps two tables based on a comparison (primary/foreign key)
* only returns things that are in BOTH tables

Example: persons and emails 

Some people dont have an email and not all emails belong to entries in the persons table. So only the ones from persons who have an email will be returned.

```
SELECT 
    person.name
    email.email
FROM person 
INNER JOIN email
ON person.mailid = email.id

-- Output: 2 persons with emails (3rd person has no mail and will not be shown)
```

---

## (LEFT) OUTER JOIN

This one gets everything from the left side (first table) and the fitting values from the right side (second table).

If there is not match, unlike the inner join, this will return the results still, but those will be null.

So if I have 3 people in the persons table and only two have an email, then I will get 3 rows with the last person having a NULL value in the email column.

NOTE: right outer join is the same, so just switch the tables and use left outer join instead.

```
SELECT 
    person.name
    email.email
FROM person 
LEFT OUTER JOIN email
ON person.mailid = email.id

-- Output: 3 persons with 2 having an email and the third just having an empty email field
```

**NOTE: There is no FULL OUTER JOIN in MySQL, just LEFT and RIGHT!!**

---

## SET FUNCTIONS

Set Functions can be used to figure out numbers and count certain values. You just need to know all 5 exist and what they do, so you know which to use.

**They always expect a column name as the parameter.**

---

### COUNT 

This function counts all the values in the column provided.

You can use where clauses to make your query more specific: 

```
SELECT COUNT(firstname) FROM persons; 
--> returns all 10 entries from the persons table

SELECT COUNT(firstname) FROM persons WHERE age >= 18; 
--> returns how many adults are in the table;

SELECT COUNT(DISTINCT firstname) FROM persons; 
--> returns amount of unique first names (if 2 people have the same name only 1 will be added to count)
```

---

### MAX & MIN

This returns the max/min value of the provided column (no NULL values included)

---

### AVG

This returns the average of all values from the column, no NULL values and only numeric columns allowed! 

---

### SUM

This returns the sum of all values from the column, no NULL values and only numeric columns allowed! 

## Other useful stuff
---

### GROUP BY 

...cause lets be honest you don't rly know how and when to use that...

if you use count to get all unique first names in the database, then you will only get the number, not the names itselves. To get those too you need a group by clause.

```
SELECT 
    COUNT(firstname), 
    firstname 
FROM persons 
GROUP BY firstname; 
```

Now there are 2 things to note: 

1. the column you use for the group by MUST be selected too (you cannot select only firstname and then group by lastname)
2. When this query executes it first groups all the names together into sets (Set1 = Lisa, Set2 = Hanna, ...) and then for each set it counts how often this set is found in the database and counts it for the COUNT function.

---

### HAVING

Now HAVING to GROUP BY is like WHERE to SELECT.
If you take the query above and want to only get the results WHERE count is bigger than 2, then you need HAVING:

```
SELECT 
    COUNT(firstname) AS c, 
    firstname 
FROM persons 
GROUP BY firstname 
HAVING c > 1;
```

returns all people who have their firstname more than once appear in the database.

---

### DISTINCT

```
SELECT DISTINCT country_name FROM persons; 
```

Unique values will be returned only. So all countries where people are from but only listed once.