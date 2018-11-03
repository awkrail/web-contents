import pickle

with open("title_url.pkl", "rb") as f:
  title_url = pickle.load(f)

base_url = "http://j-lyric.net"

for title, url in title_url.item():
  access_url = base_url + url

import ipdb; ipdb.set_trace()