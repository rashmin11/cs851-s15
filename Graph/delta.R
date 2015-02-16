delta <- read.table(file.choose(), header=T, sep="\t")
delta1 <- c(delta$Delta)
hist(delta1, col="red", xlim=c(0,7), ylim=c(0,8000))