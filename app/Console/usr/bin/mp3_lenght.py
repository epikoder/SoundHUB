import sys
import eyed3

def main():
    duration = eyed3.load(sys.argv[1])
    duration = duration.info.time_secs
    print(duration)
if __name__ == "__main__":
    main()
