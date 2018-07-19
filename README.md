# phpcore-viewparam

Data organization for the rendering engine.

This use the vdeapps/phpcore-chained-array

## PHP usage
```
$vp = ViewParam::getInstance();

// To set values
$vp->addvp(VP_LIST, 'myList', $myDataArray);
$vp->addvp(VP_DATA, 'keyname', $myDataArray);
$vp->addvp(VP_DATA, 'stringvalue', 'Hello World');
$vp->addvp(VP_DEBUG, 'forDebug', $myDataArray);
$vp->addvp(VP_FILTERS, 'form', $myDataArray);
$vp->addvp(VP_INFO, 'General', $myDataArray);
$vp->addvp(VP_MAILS, 'mailParams', $myDataArray);
$vp->addvp(VP_RESPONSE, 'responseData', $myDataArray);
$vp->addvp('customkey', 'key', 'val');


// To get values
$vp->getvp(VP_LIST, 'myList');  //Return a ChainedArray
$vp->getvp(VP_DATA, 'keyname'); //Return a ChainedArray
$vp->getvp(VP_DEBUG, 'forDebug'); //Return a ChainedArray
$vp->getvp(VP_FILTERS, 'form'); //Return a ChainedArray
$vp->getvp(VP_INFO, 'General'); //Return a ChainedArray
$vp->getvp(VP_MAILS, 'mailParams'); //Return a ChainedArray
$vp->getvp(VP_RESPONSE, 'responseData'); //Return a ChainedArray
$vp->getvp('customkey', 'key'); //Return a string

```

## TWIG usage
For use with twig, send the $vp() parameter to the render.
Thus you can use like a standard array

```
{{ list.myList }}
{{ data.keyname }}
{{ data.stringvalue }}
{{ debug.forDebug }}
{{ filters.form }}
{{ info.General }}
{{ mails.mailParams }}
{{ response.responseData }}
{{ customkey.key }}

```

