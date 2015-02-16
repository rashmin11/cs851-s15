httpcode <- read.table(file.choose(), header=T, sep="\t")
http <- c(httpcode$HTTPcode)
hist(http, col="red", ylim=c(0,30000))