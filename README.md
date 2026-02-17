# uiu-web-programming


# Final Preparation (SQL)


# 📘 SQL NOTES: CRUD + FILTERING + SORTING

---

## 🔹 CRUD মানে কী?

CRUD = **Create, Read, Update, Delete**

| Operation | SQL    |
| --------- | ------ |
| Create    | INSERT |
| Read      | SELECT |
| Update    | UPDATE |
| Delete    | DELETE |

---

## 1️⃣ CREATE (INSERT)

### ➤ নতুন data যোগ করা

```sql
INSERT INTO sales_data (ProductName, CategoryName, Revenue)
VALUES ('iPhone', 'Mobile', 60000);
```

📌 **Note**

* নতুন row add হয়
* Column order ঠিক রাখতে হবে

---

## 2️⃣ READ (SELECT)

### ➤ সব data দেখানো

```sql
SELECT * FROM sales_data;
```

### ➤ নির্দিষ্ট column

```sql
SELECT ProductName, Revenue FROM sales_data;
```

---

## 3️⃣ FILTERING (WHERE)

### ➤ condition দিয়ে data filter

```sql
SELECT * FROM sales_data
WHERE Revenue > 40000;
```

### ➤ AND / OR

```sql
SELECT * FROM sales_data
WHERE Revenue > 40000 AND CategoryName = 'Mobile';
```

```sql
SELECT * FROM sales_data
WHERE CategoryName = 'Mobile' OR CategoryName = 'Laptop';
```

---

## 4️⃣ SORTING (ORDER BY)

### ➤ Ascending (default)

```sql
SELECT * FROM sales_data
ORDER BY Revenue ASC;
```

### ➤ Descending

```sql
SELECT * FROM sales_data
ORDER BY Revenue DESC;
```

---

## 5️⃣ UPDATE

### ➤ data modify করা

```sql
UPDATE sales_data
SET Revenue = Revenue * 1.1;
```

### ➤ condition সহ

```sql
UPDATE sales_data
SET CategoryName = 'Low Performing'
WHERE Revenue < 40000;
```

📌 **Note**

* WHERE না দিলে সব row update হবে ⚠️

---

## 6️⃣ DELETE

### ➤ নির্দিষ্ট row delete

```sql
DELETE FROM sales_data
WHERE Revenue < 40000;
```

### ➤ সব row delete

```sql
DELETE FROM sales_data;
```

📌 **Dangerous**: WHERE না দিলে সব data চলে যাবে

---

## 7️⃣ AGGREGATE FUNCTIONS (Summary)

| Function | কাজ       |
| -------- | --------- |
| SUM()    | মোট       |
| AVG()    | গড়        |
| COUNT()  | সংখ্যা    |
| MAX()    | সর্বোচ্চ  |
| MIN()    | সর্বনিম্ন |

### ➤ Example

```sql
SELECT SUM(Revenue) FROM sales_data;
```

---

## 8️⃣ GROUP BY

### ➤ category-wise calculation

```sql
SELECT CategoryName, SUM(Revenue) AS TotalRevenue
FROM sales_data
GROUP BY CategoryName;
```

📌 **Rule**

* GROUP BY থাকলে SELECT এ non-aggregate column থাকতে হবে

---

## 9️⃣ HAVING (GROUP BY filter)

```sql
SELECT CategoryName, SUM(Revenue) AS TotalRevenue
FROM sales_data
GROUP BY CategoryName
HAVING SUM(Revenue) > 100000;
```

📌 WHERE → row filter
📌 HAVING → group filter

---

## 🔟 CASE (Conditional column)

```sql
SELECT ProductName, Revenue,
CASE
    WHEN Revenue > 50000 THEN 'Top Seller'
    ELSE 'Regular Seller'
END AS Label
FROM sales_data;
```

📌 CASE দিয়ে **temporary column** বানানো হয়

---

## 1️⃣1️⃣ JOIN (Basic)

```sql
SELECT s.ProductName, c.CategoryName
FROM sales_data s
JOIN category c ON s.CategoryID = c.ID;
```

📌 JOIN দিয়ে multiple table connect করা হয়

---

## 1️⃣2️⃣ CRUD in PHP (mysqli)

### ➤ SELECT

```php
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    echo $row['ProductName'];
}
```

### ➤ INSERT / UPDATE / DELETE

```php
mysqli_query($conn, $sql);
```

📌 SELECT → result set
📌 INSERT/UPDATE/DELETE → true/false

---

## 🧠 Very Important Exam Points

* `SELECT` → table structure বদলায় না
* `AS` → temporary column name
* `WHERE` ছাড়া UPDATE/DELETE dangerous
* `GROUP BY` + `SUM()` খুব common exam question
* `CASE` → label / condition based result
