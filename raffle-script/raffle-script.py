
import csv

def main():
    tickets = []
    with open('raw-raffle-cash.csv', 'rb') as csvfile:
        spamreader = csv.reader(csvfile, delimiter=',', quotechar=' ')
        for row in spamreader:
            gross = row[1]
            try:
                tix = int(gross) / 100
                for x in range(0, tix):
                    tickets.append((row[0], row[2]))
            except:
                pass
    with open('all-cash-tickets.csv', 'wb') as csvfile:
        spamwriter = csv.writer(csvfile, delimiter=',', quotechar=' ', quoting=csv.QUOTE_MINIMAL)
        for tix in tickets:
            spamwriter.writerow(tix)

if __name__ == '__main__':
    main()
