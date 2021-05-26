# Final-Year-Project-PHP-server
# The basic structure is eltMicroservice.php takes in the post request

# And processes it

# and then it reads from mapping.csv that which tags need to be replaced with what and what attributes need to be changed with what, then using the function in convertXML it does that

# and finally it converts it to a JSON, using XML2JSON.php

# Now what to do is, fill mapping.csv with the tags mapping



# once populated the mapping .csv in the following format

# To change a tag
# oldTag, newTag, "', ""

# To change a attribute of some tag

# tagName, tagName, oldAttribute name, new attribute name
