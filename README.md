# PHP Gallery

This a learning project for me to learn the syntax, features and best practices of object-oriented php.  
The folder structure template is from an Udemy course I took.

## Database

You have to specify the following env variables on your server:

- GALLERY_DB_HOST
- GALLERY_DB_NAME
- GALLERY_DB_USER
- GALLERY_DB_PASSWORD
- GALLERY_UPLOAD_FOLDER
- GALLERY_UPLOAD_PATH

Also you have to provide the schema specified under /schema.

## Cheat-Sheet Pagination

If you work with mysql use:
```
LIMIT offset, items_per_page 
```
To calculate the offset you can use:

```
$offset = ($page - 1) * $items_per_page;  
```

Then replace the $page accordingly.

### Last

```
$last_offset = ($totalPages - 1) * $items_per_page;  
```
### Previous

```
$previous_offset = (($currentPage - 1) - 1) * $items_per_page;  
```
Note that you have to check the limits otherwise you get negative offset.
### Next

```
$next_offset = (($currentPage + 1) - 1) * $items_per_page;
```  
Note that you have to check the limits otherwise you go out of bounds.
### EDIT:
```
if ($previous_offset > 0) echo '<a href="?start='.$previous_offset.'&limit='.$items_per_page.'>prev</a>';

if ($next_offset <= $totalPages * $items_per_page) echo '<a href="?start='.$next_offset.'&limit='.$items_per_page.'">
prev</a>';
```

## My disclaimer

Be warned this is only a learning project. All code residing in this project and or repo is my attempt to learn php.  
So it is possible that some code maybe not best practice or standard.

