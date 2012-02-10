from sys import argv
import PIL

from LoadIcon import load_icon

# load the icon from first argument
try:
  image = load_icon(argv[1], 0)
except IOError: # sometimes people use other file types, ie bitmaps
  image = PIL.Image.open(argv[1])

# save it to file in second argument
f = file(argv[2], "w")

image.thumbnail( (16, 16), PIL.Image.ANTIALIAS)
image.save(f, "PNG", quality=95)

f.close()

