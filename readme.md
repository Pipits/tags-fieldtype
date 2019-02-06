# Tags Field Type

A field type for adding comma-separated tags. The field type gives visual feedback to the editor, prevents editors for entering the same tag more than once and allows you to blacklist words so the editor wouldn't be able to enter them.


## Installation

- Download the field type
- Unzip the download
- Place the `tags` folder in `perch/addons/fieldtypes`.



## Requirements

- Perch or Perch Runway 3.0 or higher


## Usage

```html
<perch:content id="keywords" type="tags" label="Keywords" blacklist="this,and,is,are" max="10" placeholder="Add tags..">
```

## Attributes

| Option           | What it means                                                          |
|------------------|------------------------------------------------------------------------|
| max              | The maximum number of tags that can be entered                         |
| blacklist        | A comma-separated list of words you don't want the field to accept     |
| placeholder      | A placeholder text                                                     |


## Uses

A common use of the field type would be for the `<meta name="keywords">` tag:

```html
<meta name="keywords" content="<perch:content id="keywords" type="tags" label="Keywords">" />
```

Another possible use is if you're implementing a keyword-based search for things like Collection items, (multi-item)Region items, Blog posts, etc:

```php
perch_collection('Movies', [
    'filter' => 'keywords', // field id="keywords"
    'match' => 'contains', // simple search
    'value' => 'action', // a single keyword
])
```

For the above keyword-based search to work effectively for user-input search, you would probably need to have an auto-complete feature on the search field on your site's front-end.