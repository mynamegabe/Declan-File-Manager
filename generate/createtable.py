#!/usr/bin/env python3
# Script to generate sqlite db file
import sqlite3

websites = [("159movies.com","dyK+76q7%};B"),
              ("coursera.org","qL}j5_8EnB9R"),
              ("hackthebox.eu","uKz[=p)e89WK"),
              ("Unknown website","0uch_i_h4t3_1nj3ct10ns")]

conn = sqlite3.connect('../service/src/passwords.db')
c = conn.cursor()
c.execute("CREATE TABLE websites (website text, password text)")
c.executemany('INSERT INTO websites VALUES (?,?)',websites)
conn.commit()
conn.close()
